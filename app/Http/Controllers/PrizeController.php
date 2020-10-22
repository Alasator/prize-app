<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserPrize;

class PrizeController extends Controller
{


    public function prize()
    {

        $currentType = array_rand(UserPrize::TYPES);
        $user = \Auth::user();
        $sent_status = 0;
        if (UserPrize::TYPES[$currentType] == 'item') {
            $value = 1;
            $message = 'Вы выиграли предмет,c вами свяжется наш менеджер для отправки предмета';

        } elseif (UserPrize::TYPES[$currentType] == 'money') {
            $value = rand(10, 100);
            $message = 'Вы выиграли: ' . $value . '$';
        } else {
            $value = rand(25, 150);
            $message = 'Вы выиграли: бонусные баллы лояльности ' . $value . '. Они переведены на ваш счет';

            $user->loyalty_points += $value;
            $user->save();
            $sent_status = 1;
        }

        /*try {*/
          $userPrize = UserPrize::create([
                'value' => $value,
                'type' => $currentType,
                'user_id' => $user->id,
                'sent_status'=> $sent_status
            ]);
      /*  }
        catch (\Exception $e){
          $message =  $e->getMessage();
        }*/
        return response()->json([
            'message' => $message,
            'value' => $value,
            'type' => $currentType,
            'id'=> $userPrize->id
        ]);

    }

    public function loyalty(Request $request)
    {
        $loyalty_points = round($request->value * UserPrize::COEFFICIENT);
        try {
        $user = \Auth::user();
        $user->loyalty_points += $loyalty_points;
        $user->save();
        $message = 'Ваш выигрыш конвертирован в бонусные баллы, вы получили ' . $loyalty_points . ' очков лояльности';
          }
       catch (\Exception $e) {
         $message =  $e->getMessage();
       }

        return response()->json([
            'message' => $message
        ]);
    }

    public function return(Request $request)
    {

        UserPrize::destroy($request->id);
        $message = 'Ваш подарок вернулся, спасибо за участие!';
        return response()->json([
            'message' => $message
        ]);
    }
}
