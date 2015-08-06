<?php

	namespace gui\actionBar;

	class actionBar
	{

		private $registry;
		private $iconOutput;
		private $clockOutput;
		private $actionBarOutput;

		public function __construct($registry) {
			$this->registry = $registry;
		}

		public function buildIcon()
		{
			if (!empty($this->registry)) {
				foreach($this->registry as $program) {
						$this->iconOutput = '<li class="actionBar-program-icon" data-program-id="' . $program['id'] . '" data-program-name="' . $program['name'] . '"><span>' . $program['initials'] . '</span><label>'. $program['name']  .'</label></li>';
					}

				$this->iconOutput =  '<nav>
										<ul id="program-icons">'
											. $this->iconOutput .
										'</ul>
									</nav>';

				return true;
			} else {
				error_log("Registry Build Failed. Empty registry array passed.");

				return false;
			}
		}

		public function getIcon()
		{
			if (!empty($this->iconOutput)) {
				return $this->iconOutput;
			} else {
				error_log("Failed to execute getIcon(). No Icon Output Found");
				return false;
			}
		}

		public function buildClock()
		{
			$this->clockOutput = '<calender><span>--:--</span></calender>';
		}

		public function getClock()
		{
			if (!empty($this->clockOutput)) {
				return $this->clockOutput;
			} else {
				error_log("Failed to execute getCalender(). No Calender Output Found");
				return false;
			}
		}

		public function buildCalender()
		{

		}

		public function getCalender()
		{

		}

		public function buildActionBar()
		{
			if (!empty($this->iconOutput) && !empty($this->clockOutput)) {
				$this->actionBarOutput = '<actionBar>' . $this->iconOutput . $this->clockOutput . '</actionBar>';

				return true;
			} else {
				error_log("Failed to execute buildActionBar(). Missing content.");
				return false;
			}
		}

		public function getActionBar()
		{
			if (!empty($this->actionBarOutput)) {
				return $this->actionBarOutput;
			} else {
				error_log("Failed to execute getActionBar(). No Calender Output Found");
				return false;
			}
		}

	}
