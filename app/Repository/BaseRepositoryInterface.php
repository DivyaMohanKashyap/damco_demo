<?php
 
 namespace App\Repository;


 interface BaseRepositoryInterface {
    
      public function getAll();
 
      public function destroy($id);
 
      public function createOrUpdate($request, $id = null);
   }

?>