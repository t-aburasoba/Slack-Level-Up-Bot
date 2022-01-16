<?php

namespace App\Repositories\LevelsExperience;

use App\Models\LevelsExperience;

class LevelsExperienceRepository implements LevelsExperienceRepositoryInterface
{
    /**
     * @var LevelsExperience
     */
    protected $levelsExperience;

    /**
     * LevelsExperienceRepository constructor.
     *
     * @param LevelsExperience $levelsExperience
     */
    public function __construct(LevelsExperience $levelsExperience)
    {
        $this->levelsExperience = $levelsExperience;
    }

    /**
     *
     * @param $level
     * @return mixed
     */
    public function getByLevel($level)
    {
        return $this->levelsExperience
            ->where('level', $level)
            ->first();
    }
}
