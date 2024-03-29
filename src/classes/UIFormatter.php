<?php
namespace RafaelMoran\UITest;

class UIFormatter
{
	/** @var string */
	public static $check_mark = "\xE2\x9C\x94";

	/**
	 * Gives format and outputs a message.
	 *
	 * @param array $tests
	 * @param boolean $verbose
	 * @return void
	 */
	public static function formatAndOutput(array $tests, bool $verbose = false) 
	{
		$test_counter 		= 0;
		$test_case_counter 	= 0;
		$assertion_counter 	= 0;

		$assertion_not_passed_counter = 0;

		foreach ($tests as $test_case_name => $test_cases) {

			foreach ($test_cases as $test_name => $assertions) {

				foreach ($assertions as $assertion) {

					extract($assertion);

					$variables = '';

					foreach ($args as $index => $value) {
						$variables .= "$index=>" . (is_array($value) ? json_encode($value) : $value)  . ", ";
					}
					
					$color = "green";
					$icon = self::$check_mark;	

					if( ! $status ){
						$assertion_not_passed_counter++;
						$color = "red";
						$icon = "x";
					}

					// self::setColor($icon, $color, $verbose);
					// self::setColor(" " . $name . ": ", "white", $verbose);
					// self::setColor(rtrim($variables, ', ') . "\n", "", $verbose);

					flush();

					$assertion_counter++;

				}

				$test_case_counter++;

			}

			$test_counter++;

		}

		$verbose = true;

		self::setColor("\n\nUITest status:", "bgreen", $verbose);

		if ( $assertion_not_passed_counter ) {
			self::setColor(" Failed! ", "bgired", $verbose);
		}

		if ( $assertion_not_passed_counter == 0 ) {
			self::setColor(" Passed! ", "bigreen", $verbose);
		}

		self::setColor("\n\n", "", $verbose);
		self::setColor("Total test cases:", "yellow", $verbose);
		self::setColor(" " . $test_counter, "white", $verbose);

		self::setColor(" Total tests:", "yellow", $verbose);
		self::setColor(" " . $test_case_counter, "white", $verbose);

		self::setColor(" Total assertions:", "yellow", $verbose);
		self::setColor(" " . $assertion_counter, "white", $verbose);

		self::setColor(" [", "", $verbose);
		self::setColor("{$check_mark}", "green", $verbose);
		self::setColor(( $assertion_counter - $assertion_not_passed_counter ), "", $verbose);
		self::setColor("]", "", $verbose);

		self::setColor("[", "", $verbose);
		self::setColor("x", "red", $verbose);
		self::setColor("{$assertion_not_passed_counter}", "", $verbose);
		self::setColor("]\n", "", $verbose);
	}

	/**
	 * Sets color to a string.
	 *
	 * @param string $str
	 * @param string $color
	 * @param boolean $verbose
	 * @param boolean $new_line
	 * @return void
	 */
	public static function setColor(string $str, 
								string $color = '', 
								bool $verbose = false,
								bool $new_line = false ) : void
	{
		$check_mark		= "\xE2\x9C\x94";

		# Special characters
		$const		= "\033[";
		$coff		= "{$const}0m";

		# Regular Colors
		$red		= "{$const}0;31m";          # Red
		$green		= "{$const}0;32m";        # green
		$yellow		= "{$const}0;33m";       # yellow
		$blue		= "{$const}0;34m";         # blue
		$purple		= "{$const}0;35m";       # purple
		$cyan		= "{$const}0;36m";         # cyan
		$gray		= "{$const}0;37m";          # gray
		$white		= "{$const}0;37m";        # white

		# Bold
		$bgdray		= "{$const}1;30m";         # dark gray
		$bred		= "{$const}1;31m";         # red
		$bgreen		= "{$const}1;32m";       # green
		$byellow	= "{$const}1;33m";      # yellow
		$bblue		= "{$const}1;34m";        # blue

		# Underline
		$ured		= "{$const}4;31m";         # red
		$ugreen		= "{$const}4;32m";       # green
		$uyellow	= "{$const}4;33m";      # yellow
		$ublue		= "{$const}4;34m";        # blue
		$uwhite		= "{$const}4;37m";       # white
		$ucyan		= "{$const}4;36m";        # cyan

		# background
		$bgred		= "{$const}41m";         # red
		$bggreen	= "{$const}42m";       # green
		$bgyellow	= "{$const}43m";      # yellow
		$bgblue		= "{$const}44m";        # blue

		# High intensity backgrounds
		$bgiblack	= "{$const}0;100m";   # black
		$bgired		= "{$const}0;101m";     # red
		$bgigreen	= "{$const}0;102m";   # green
		$bgiyellow	= "{$const}0;103m";  # yellow

		$bigreen	= "{$const}1;92m";      # green

		if (! $verbose) {
			return;
		}
		
		if (! empty($color)) {
			echo "{$$color}";
		}

		echo "{$str}{$coff}";

		if ($new_line) {
			echo "\n";
		}
	}

	/*
	
	# TODO:
	# Color off
	$coff		= "\033[0m";

	# Regular Colors
	$black		= "\033[0;30m";        # black
	$red		= "\033[0;31m";          # Red
	$green		= "\033[0;32m";        # green
	$yellow		= "\033[0;33m";       # yellow
	$blue		= "\033[0;34m";         # blue
	$purple		= "\033[0;35m";       # purple
	$cyan		= "\033[0;36m";         # cyan
	$white		= "\033[0;37m";        # white

	# Bold
	$bblack		= "\033[1;30m";       # black
	$bred		= "\033[1;31m";         # red
	$bgreen		= "\033[1;32m";       # green
	$byellow	= "\033[1;33m";      # yellow
	$bblue		= "\033[1;34m";        # blue
	$bpurple	= "\033[1;35m";      # purple
	$bcyan		= "\033[1;36m";        # cyan
	$bwhite		= "\033[1;37m";       # white

	# Underline
	$ublack		= "\033[4;30m";       # black
	$ured		= "\033[4;31m";         # red
	$ugreen		= "\033[4;32m";       # green
	$uyellow	= "\033[4;33m";      # yellow
	$ublue		= "\033[4;34m";        # blue
	$upurple	= "\033[4;35m";      # purple
	$ucyan		= "\033[4;36m";        # cyan
	$uwhite		= "\033[4;37m";       # white

	# background
	$bgblack	= "\033[40m";       # black
	$bgred		= "\033[41m";         # red
	$bggreen	= "\033[42m";       # green
	$bgyellow	= "\033[43m";      # yellow
	$bgblue		= "\033[44m";        # blue
	$bgpurple	= "\033[45m";      # purple
	$bgcyan		= "\033[46m";        # cyan
	$bgwhite	= "\033[47m";       # white

	# High intensity
	$iblack		= "\033[0;90m";       # black
	$ired		= "\033[0;91m";         # red
	$igreen		= "\033[0;92m";       # green
	$iyellow	= "\033[0;93m";      # yellow
	$iblue		= "\033[0;94m";        # blue
	$ipurple	= "\033[0;95m";      # purple
	$icyan		= "\033[0;96m";        # cyan
	$iwhite		= "\033[0;97m";       # white

	# bold High intensity
	$biblack	= "\033[1;90m";      # black
	$bired		= "\033[1;91m";        # red
	$bigreen	= "\033[1;92m";      # green
	$biyellow	= "\033[1;93m";     # yellow
	$biblue		= "\033[1;94m";       # blue
	$bipurple	= "\033[1;95m";     # purple
	$bicyan		= "\033[1;96m";       # cyan
	$biwhite	= "\033[1;97m";      # white

	# High intensity backgrounds
	$bgiblack	= "\033[0;100m";   # black
	$bgired		= "\033[0;101m";     # red
	$bgigreen	= "\033[0;102m";   # green
	$bgiyellow	= "\033[0;103m";  # yellow
	$bgiblue	= "\033[0;104m";    # blue
	$bgipurple	= "\033[0;105m";  # purple
	$bgicyan	= "\033[0;106m";    # cyan
	$bgiwhite	= "\033[0;107m";   # white

	echo $yellow . "This text is yellow" . $coff;
	*/
}
