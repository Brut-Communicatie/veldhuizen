<?php
/**
 * WPThemeReview Coding Standard.
 *
 * @package WPTRT\WPThemeReview
 * @link    https://github.com/WPTRT/WPThemeReview
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WPThemeReview\Sniffs\ThouShallNotUse;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Check for auto generated themes.
 *
 * @since 0.1.0
 */
class NoAutoGenerateSniff implements Sniff {

	/**
	 * A list of tokenizers this sniff supports.
	 *
	 * @var array
	 */
	public $supportedTokenizers = [
		'PHP',
		'CSS',
	];

	/**
	 * A list of strings found in the generated themes.
	 *
	 * @var array
	 */
	protected $generated_themes = [
		'artisteer', // Artisteer.
		'themler', // Themler.
		'lubith', // Lubith.
		'templatetoaster', // TemplateToaster.
		'wpthemegenerator', // WP Theme Generator.
		'pinegrow', // Pinegrow.
	];

	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register() {
		$tokens   = Tokens::$textStringTokens;
		$tokens[] = T_STRING; // Functions named after or prefixed with the generator name.
		$tokens[] = T_COMMENT;
		$tokens[] = T_DOC_COMMENT_STRING;
		return $tokens;
	}

	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
	 *                                               token was found.
	 * @param int                         $stackPtr  The position of the current token
	 *                                               in the stack.
	 *
	 * @return void
	 */
	public function process( File $phpcsFile, $stackPtr ) {

		$tokens  = $phpcsFile->getTokens();
		$token   = $tokens[ $stackPtr ];
		$content = trim( strtolower( $token['content'] ) );

		// No need to check an empty string.
		if ( '' === $content ) {
			return;
		}

		foreach ( $this->generated_themes as $generated_theme ) {
			/*
			 * The check can have false positives like artisteers but chances of that happening
			 * in a valid theme is low.
			 */
			if ( false === strpos( $content, $generated_theme ) ) {
				continue;
			}

			$phpcsFile->addError(
				'Auto generated themes are not allowed in the theme directory. Found: %s',
				$stackPtr,
				'AutoGeneratedFound',
				[ $generated_theme ]
			);
		}
	}

}
