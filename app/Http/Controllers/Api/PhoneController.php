<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Providers\PusherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    public function getPhone () {
        try {
            return response()->json(arr_result('success', true, Phone::whereUserId(Auth::user()->id)->get()));
        } catch (\Throwable $th) {
            return response()->json(arr_result($th->getMessage(), false, []));
        }
    }

    public function storePhone () {
        try {
            $validator = \Validator::make(request()->all(), [
                'phone_number' => 'required|string|max:255|unique:phones,phone_number',
                'provider' => 'required|string|max:255',
            ]);

            if($validator->fails()) {
                return response()->json(arr_result('validation errors', false, ['errors' => $validator->errors()->first()]));
            }

            $phone = Phone::create([
                'phone_number' => request('phone_number'),
                'provider' => request('provider'),
                'user_id' => Auth::user()->id,
            ]);
            (new PusherService())->push('jti-channel', 'phone-created', $phone);
            return response()->json(arr_result('data stored', true, $phone));
        } catch (\Throwable $th) {
            return response()->json(arr_result($th->getMessage(), false, []));
        }
    }

    public function deletePhone( Phone $phone ) {
        try {
            if ($phone->user_id != Auth::user()->id) {
                return response()->json(arr_result('failed, you have no permission to do this action', false, []));
            }
            $phone->delete();
            return response()->json(arr_result('success, data deleted', true, []));
        } catch (\Throwable $th) {
            return response()->json(arr_result($th->getMessage(), false, []));
        }
    }

    public function updatePhone( Phone $phone ) {
        try {
            if ($phone->user_id != Auth::user()->id) {
                return response()->json(arr_result('failed, you have no permission to do this action', false, []));
            }
            $validator = \Validator::make(request()->all(), [
                'phone_number' => 'required|string|max:255|unique:phones,phone_number,'.$phone->id,
                'provider' => 'required|string|max:255',
            ]);
            $phone->update([
                'phone_number' => request('phone_number'),
                'provider' => request('provider'),
            ]);

            if($validator->fails()) {
                return response()->json(arr_result('validation errors', false, ['errors' => $validator->errors()]));
            }
            return response()->json(arr_result('success, data updated', true, $phone));
        } catch (\Throwable $th) {
            return response()->json(arr_result($th->getMessage(), false, []));
        }
    }
}
