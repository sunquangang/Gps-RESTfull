<?php namespace App\Category;


class Repository implements RepositoryInterface
{

    public function all(){
      try {
        $profile = Profile::all();
        if (!$profile) {
              return \Response::api()->errorNotFound('Collection not found');
          } else {
            return \Response::api()->withCollection($profile, New ProfileTransformer);
        }
      } catch (Exception $e){
        return \Response::api()->errorForbidden('Something did nok work as intented!');
      } 
    }
}