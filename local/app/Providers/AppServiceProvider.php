<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//           Validator::extend('is_unique_with', function($attribute, $value, $parameters, $validator) {
//
//            if(!empty($value) && (strlen($value) % 2) == 0){
//
//                return true;
//
//            }
//
//                return false;
//
//        });
        Validator::extend('soft_composite_unique', function ($attribute, $value, $parameters, $validator) {
            // Custom validation logic

            // remove first parameter and assume it is the table name
            $table = array_shift( $parameters ); 

            // start building the conditions
           // $fields = [ $attribute => $value ]; // current field, company_code in your case
            $ar= array_shift( $parameters ); 
            $fields[] =array($ar,$value) ;
            // iterates over the other parameters and build the conditions for all the required fields
            while ( $field = array_shift( $parameters ) ) {
                if (strpos($field, '=') !== false) {
                    $fd=explode('=',$field);
                    $fields[]  =array($fd[0],$fd[1]) ;
                }  else {
                     $fields[]  =array('id','!=',$field) ;
                }
               
            }
           $fields[]=array('is_delete','0');
           $fields[]=array('parent_id','!=','0');
            // query the table with all the conditions
            $result = \DB::table( $table )->select( \DB::raw( 1 ) )->where( $fields )->first();
          
            return empty( $result );
        }, 'This value :attribute already exists!');
        
          Validator::extend('soft_unique', function ($attribute, $value, $parameters, $validator) {
            // Custom validation logic

            // remove first parameter and assume it is the table name
            $table = array_shift( $parameters ); 

            // start building the conditions
           // $fields = [ $attribute => $value ]; // current field, company_code in your case
           
            $ar= array_shift( $parameters ); 
            $fields[] =array($ar,$value) ;
            // iterates over the other parameters and build the conditions for all the required fields
            while ( $field = array_shift( $parameters ) ) {
                if (strpos($field, '=') !== false) {
                    $fd=explode('=',$field);
                    $fields[]  =array($fd[0],$fd[1]) ;
                }  else {
                     $fields[]  =array('id','!=',$field) ;
                }
               
            }
           $fields[]=array('is_delete','0');
           $fields[]=array('parent_id','0');
            // query the table with all the conditions
            $result = \DB::table( $table )->select( \DB::raw( 1 ) )->where( $fields )->first();
          
            return empty( $result );
        }, 'This value :attribute already exists!');
         Validator::extend('soft_unique_single', function ($attribute, $value, $parameters, $validator) {
            
            // Custom validation logic

            // remove first parameter and assume it is the table name
            $table = array_shift( $parameters ); 

            // start building the conditions
           // $fields = [ $attribute => $value ]; // current field, company_code in your case
           
            $ar= array_shift( $parameters ); 
            $fields[] =array($ar,$value) ;
            // iterates over the other parameters and build the conditions for all the required fields
            while ( $field = array_shift( $parameters ) ) {
                if (strpos($field, '=') !== false) {
                    $fd=explode('=',$field);
                    $fields[]  =array($fd[0],$fd[1]) ;
                }  else {
                     $fields[]  =array('id','!=',$field) ;
                }
               
            }
           $fields[]=array('is_delete','0');
         
            // query the table with all the conditions
            $result = \DB::table( $table )->select( \DB::raw( 1 ) )->where( $fields )->first();
          
            return empty( $result );
        }, 'This value :attribute already exists!');
         
         
     Validator::extend('check_demension_value', function ($attribute, $value, $parameters, $validator) {
        //print_r($parameters); echo $value ;
        if($value > 0)
        {
            return true;
        }
        else{
            return false;
        }
        
     },'This value :attribute should be greater than zero.');
     
     Validator::extend('check_date_valid', function ($attribute, $value, $parameters, $validator) {
        $date = date('Y-m-d');
        if($value >= $date)
        {
            return true;
        }
        else{
            return false;
        }
        
     },'This value :attribute should be equal to or greater than today Date.');
     

    Validator::extend('check_date_to_valid', function ($attribute, $value, $parameters, $validator) {
        //print_r($parameters); //echo $value ;
        $date_from = array_get($validator->getData(), $parameters[0], null); 
        if($value >= $date_from)
        {
            return true;
        }
        else{
            return false;
        }
        
     },'This value :attribute should be equal to or greater than Date From.');
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
