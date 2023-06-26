<?php

// ecs.php
use PhpCsFixer\Fixer\Basic\CurlyBracesPositionFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSpaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\StringNotation\ExplicitStringVariableFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\CodingStandard\Fixer\Spacing\SpaceAfterCommaHereNowDocFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
	// A. full sets
	$ecsConfig->sets([SetList::PSR_12, SetList::SYMPLIFY, SetList::COMMON, SetList::CLEAN_CODE]);
	$ecsConfig->rule(NoExtraBlankLinesFixer::class);
	$ecsConfig->rule(DisallowLongArraySyntaxSniff::class);
	$ecsConfig->ruleWithConfiguration(CurlyBracesPositionFixer::class, [
		'functions_opening_brace' => 'same_line',
		'anonymous_functions_opening_brace' => 'same_line',
	]);
	$ecsConfig->ruleWithConfiguration(GeneralPhpdocAnnotationRemoveFixer::class, [
		'annotations' => ['throws', 'group', 'covers', 'category']
	]);

	$ecsConfig->indentation('tab');

	$ecsConfig->paths([
		__DIR__ . '/ecrire/tests',
		# __DIR__ . '/index.php',
		# __DIR__ . '/spip.php',
		# __DIR__ . '/ecrire',
		# __DIR__ . '/prive',
	]);

	$ecsConfig->skip([
		__DIR__ . '/ecrire/lang',
		ArrayListItemNewlineFixer::class,
		ArrayOpenerAndCloserNewlineFixer::class,
		AssignmentInConditionSniff::class,
		DeclareStrictTypesFixer::class,
		ExplicitStringVariableFixer::class,
		MethodChainingNewlineFixer::class,
		NotOperatorWithSuccessorSpaceFixer::class,
		NotOperatorWithSpaceFixer::class,
		UnaryOperatorSpacesFixer::class,
		PhpdocNoPackageFixer::class,
		SpaceAfterCommaHereNowDocFixer::class,
		StrictComparisonFixer::class,
	]);
};
