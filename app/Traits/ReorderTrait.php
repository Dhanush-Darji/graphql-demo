<?php

namespace App\Traits;

use App\Library\SortOrderHelper;
use Carbon\Carbon;

trait ReorderTrait
{
    public function updateSortOrderAndReorder($model,$object, $newOrderInput)
    {
        $currentSortOrder = $object->order;
        $this->updateSortOrder($object,$newOrderInput);
        $sortOrderUpdateDirection = $model->sortOrderUpdateDirection;
        if (is_int($currentSortOrder) && is_int($newOrderInput)) {
            if ($currentSortOrder > $newOrderInput) {
                $sortOrderUpdateDirection = $model->sortOrderUpdateDirection;
            } elseif ($currentSortOrder < $newOrderInput) {
                $sortOrderUpdateDirection = $model->sortOrderUpdateDirection == 'asc' ? 'desc' : 'asc';
            }
        }

        $this->reorder($model, $object, $sortOrderUpdateDirection);

        return true;
    }

    public function updateSortOrder($object, $newOrderInput)
    {
        $newOrder = SortOrderHelper::getReinvigoratedSortOrder($object,$newOrderInput);
        $input['order_updated_at'] = Carbon::now();
        if ($object->order != $newOrderInput) {
            $input['order'] = $newOrder;
        }
        $object->update($input);

        return true;
    }

    public function reorder($model, $object, $sortOrderUpdateDirection = 'desc')
    {
        $responseObject = $model->getBySortOrder($object, $sortOrderUpdateDirection);
        $newSortOrder = 1;
        foreach ($responseObject as $response) {
            $response->update([
                'order' => $newSortOrder++,
                ]);
        }
        return true;
    }
}
