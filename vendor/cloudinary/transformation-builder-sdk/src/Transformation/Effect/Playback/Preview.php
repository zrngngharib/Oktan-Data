<?php
/**
 * This file is part of the Cloudinary PHP package.
 *
 * (c) Cloudinary
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cloudinary\Transformation;

use Cloudinary\ClassUtils;
use Cloudinary\Transformation\Argument\GenericNamedArgument;
use Cloudinary\Transformation\Argument\Range\PreviewDuration;

/**
 * Class Preview
 */
class Preview extends EffectAction
{
    /**
     * Preview constructor.
     *
     * @param mixed|object $duration
     * @param mixed        $maximumSegments
     * @param mixed|null   $minimumSegmentDuration
     */
    public function __construct($duration = null, $maximumSegments = null, mixed $minimumSegmentDuration = null)
    {
        parent::__construct(PlaybackEffect::PREVIEW);

        $this->duration($duration);
        $this->maximumSegments($maximumSegments);
        $this->minimumSegmentDuration($minimumSegmentDuration);
    }

    /**
     * @param mixed|object $duration
     *
     */
    public function duration(mixed $duration): static
    {
        $this->getMainQualifier()->add(ClassUtils::verifyInstance($duration, PreviewDuration::class));

        return $this;
    }

    public function maximumSegments($maximumSegments): static
    {
        if ($maximumSegments) {
            $this->getMainQualifier()->add(new GenericNamedArgument('max_seg', $maximumSegments));
        }

        return $this;
    }

    public function minimumSegmentDuration($minimumSegmentDuration): static
    {
        if ($minimumSegmentDuration) {
            $this->getMainQualifier()->add(new GenericNamedArgument('min_seg_dur', $minimumSegmentDuration));
        }

        return $this;
    }
}
