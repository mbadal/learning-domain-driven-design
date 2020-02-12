<?php declare(strict_types=1);

namespace LearningDdd\Entity\Domain;

use LearningDdd\ValueObject\Domain\CvDraftId;
use LearningDdd\ValueObject\Domain\UserId;

class CvDraft
{
    /** @var CvDraftId */
    private $id;

    /** @var UserId */
    private $userId;

    /** @var CvDraftVersion[] */
    private $versions;
}
