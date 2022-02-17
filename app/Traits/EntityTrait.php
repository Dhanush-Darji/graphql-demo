<?php

namespace App\Traits;

use Carbon\Carbon;

trait EntityTrait
{
    public function archive($model, $ids, $action)
    {
        $ids = explode(',', $ids);
        foreach ($ids as $id) {
            $entity = $model::find($id);
            if(empty($entity)){
                break;
            }
            switch ($action) {
                case 'archive':
                    $entity->archived_at = Carbon::now();
                    $entity->update();
                    break;
                case 'unarchive':
                    $entity->archived_at = NULL;
                    $entity->update();
                    break;
                case 'delete':
                    $entity->delete();
                    break;
            }
        }
    }
}
