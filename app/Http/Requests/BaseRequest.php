<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function validated()
    {
        $validated = parent::validated();
        $fields = $this->requestFields();
        return $this->getRequestFields($validated, $fields);
    }

    protected function getRequestFields($data, $keys)
    {
        $return = [];
        foreach ($keys as $key) {
            if (!empty($data[$key])) {
                $return[$key] = $data[$key];
            }
        }

        return $return;
    }

    abstract protected function requestFields();
}
