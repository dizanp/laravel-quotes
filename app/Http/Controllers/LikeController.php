<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Models\Like;
use App\Models\Quote;
use App\Models\QuoteComment;


class LikeController extends Controller
{
    public function Like($type, $model_id)
    {

        $results    = $this->check_type($type,$model_id);
        $model_type = $results[0];
        $model      = $results[1];

        //user kaga boleh ngelike Sendiri
        if(Auth::user()->id == $model->user->id)
          die('0');

        //user kaga boleh ngelike berkali-kali
        if($model->is_liked() == null) {
          Like::create([
            'user_id' => Auth::user()->id,
            'likeable_id' => $model_id,
            'likeable_type' => $model_type,
          ]);
        }
    }

        public function Unlike($type, $model_id)
        {
            $results    = $this->check_type($type, $model_id);
            $model_type = $results[0];
            $model      = $results[1];

            //user kaga boleh unlike berkali-kali
            if($model->is_liked()) {
              Like::where('user_id', Auth::user()->id)
                      ->where('likeable_id', $model_id)
                      ->where('likeable_type', $model_type)
                      ->delete();
            }

        }

      public function check_type($type, $model_id)
      {
          if($type == 1){
            $model_type = "App\Models\Quote";
            $model = Quote::find($model_id);
          }
          else{
            $model_type = "App\Models\QuoteComment";
            $model = QuoteComment::find($model_id);
          }

          return array($model_type,$model);

      }



}
