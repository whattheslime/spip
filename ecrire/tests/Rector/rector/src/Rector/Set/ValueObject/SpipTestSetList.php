<?php

declare (strict_types=1);
namespace Utils\Rector\Rector\Set\ValueObject;

use Rector\Set\Contract\SetListInterface;
/**
 * @api
 */
final class SpipTestSetList implements SetListInterface
{
	public const ESSAIS_MIGRATION = __DIR__ . '/../../../../config/set/spip_test_essais_migration.php';
}
