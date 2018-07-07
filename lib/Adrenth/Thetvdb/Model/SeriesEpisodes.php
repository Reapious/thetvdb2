<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * Class SeriesEpisodes
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method Collection getData()
 * @method Links getLinks()
 */
class SeriesEpisodes extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        if (!array_key_exists('links', $values)) {
            throw InvalidArgumentException::expectedIndex('links');
        }

        $items = [];

        foreach ((array) $values['data'] as $basicEpisode) {
            $items[] = new Episode(['data' => $basicEpisode]);
        }

        parent::__construct([
            'data' => new Collection($items),
            'links' => new Links($values['links']),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): array
    {
        return [
            'data',
            'links',
        ];
    }
}
