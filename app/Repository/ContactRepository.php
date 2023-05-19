<?php namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Contact};

class ContactRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new Contact);
    }

    /**
     * @return mixed
     */
    public function getAllQuery(): mixed
    {
        return $this->getRepository()
            ->query()
            ->when(\request("status"), function ($query){
                $status = (\request("status") === "true")?? false;
                return $query->where("status",$status);
            })
            ->get();
    }
    /**
     * @param array $attributes
     * @return Model|null
     */
    protected function saveRepository(array $attributes): ?Model
    {
        return $this->getRepository()->create($attributes);
    }

    /**
     * @param array $attributes
     * @param string $id
     * @return Model|null
     */
    protected function updateRepository(array $attributes,string $id): ?Model
    {
        return $this->save([
            "id" => $id
        ],$attributes);
    }

}
