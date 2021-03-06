<?php
/**
 * A test to ensure that arrays declarations do not have a trailing comma.
 *
 * PHP version 5
 *
 * @author    Jason McCreary <jmac@viastudio.com>
 * @link      https://github.com/viastudio/coding-standards
 */

/**
 * A test to ensure that arrays declarations do not have a trailing comma.
 *
 * @author    Jason McCreary <jmac@viastudio.com>
 * @link      https://github.com/viastudio/coding-standards
 */
class Via_Sniffs_Arrays_NoTrailingCommaSniff implements PHP_CodeSniffer_Sniff {
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register() {
        return array(T_ARRAY);
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The current file being checked.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
        $tokens = $phpcsFile->getTokens();
				$previous = $phpcsFile->findPrevious(PHP_CodeSniffer_Tokens::$emptyTokens, ($tokens[$stackPtr]['parenthesis_closer'] - 1), null, true);

        if ($tokens[$previous]['code'] === T_COMMA) {
            $error = 'Comma not allowed after last value in array declaration';
            $phpcsFile->addError($error, $previous, 'NotAllowed');
        }
    }
}