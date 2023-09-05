<?php

namespace App\Repositories\Transport;

use App\Models\Transport\transport;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class transportRepository.
 */
class transportRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return transport::class;
    }
    public function storeTransport(array $input)
    {
        $transport=new transport();
        $transport->transport_name=$input['transport_name'];
        $transport->save();
    }
}
