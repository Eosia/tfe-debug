<?php

namespace App\Services;

use App\Models\{
    Job,
};


class JobService
{
    public function getAll($query, ?string $sort)
    {

        switch ($sort) {
            case 'asc':
                $jobs = Job::query()->orderBy('title');
                break;
            case 'desc':
                $jobs = Job::query()->orderByDesc('title');
                break;
            case 'newest':
                $jobs = Job::query()->latest('updated_at');
                break;
            case 'oldest':
                $jobs = Job::query()->oldest('updated_at');
                break;
            case 'popular':
                $jobs = Job::query()->withCount('proposals')->orderByDesc('proposals_count');
                break;
            default:
                $jobs = Job::query()->orderByDesc('updated_at');
                break;
        }

        return $jobs->paginate(10)->withQueryString();
    }
}
