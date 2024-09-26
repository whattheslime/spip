<?php

use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\Basic\CurlyBracesPositionFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSpaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\StringNotation\ExplicitStringVariableFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return ECSConfig::configure()
	->withPaths([__DIR__ . '/ecrire'])
	->withRootFiles()
	->withSpacing(Option::INDENTATION_TAB)
	->withPreparedSets(psr12: true, common: true, cleanCode: true, symplify: true)
	->withConfiguredRule(CurlyBracesPositionFixer::class, [
		'functions_opening_brace' => 'same_line',
		'anonymous_functions_opening_brace' => 'same_line',
	])
	->withConfiguredRule(GeneralPhpdocAnnotationRemoveFixer::class, [
		'annotations' => ['throws', 'group', 'covers', 'category'],
	])
	->withRules([NoExtraBlankLinesFixer::class, DisallowLongArraySyntaxSniff::class])
	->withSkip([
		__DIR__ . '/ecrire/lang',
		ArrayListItemNewlineFixer::class,
		ArrayOpenerAndCloserNewlineFixer::class,
		ExplicitStringVariableFixer::class,
		NotOperatorWithSuccessorSpaceFixer::class,
		NotOperatorWithSpaceFixer::class,
		UnaryOperatorSpacesFixer::class,
		AssignmentInConditionSniff::class,
	])
;
