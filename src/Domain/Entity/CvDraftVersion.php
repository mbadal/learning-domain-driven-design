<?php declare(strict_types=1);


namespace LearningDdd\Entity\Domain;


use LearningDdd\ValueObject\Domain\CvDraftVersionId;
use LearningDdd\ValueObject\Domain\CvDraftVersionJsonState;

class CvDraftVersion
{
    /** @var CvDraftVersionId */
    private $id;

    /** @var CvDraftVersionJsonState */
    private $state;
}
