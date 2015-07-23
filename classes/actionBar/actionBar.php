<?php

	namespace gui\actionBar;

	class actionBar
	{

		private $registry;
		private $iconOutput;
		private $calenderOutput;
		private $actionBarOutput;

		public function __construct($registry) {
			$this->registry = $registry;
		}

		public function buildIcon() 
		{
			if (!empty($this->registry)) {
				foreach($this->registry as $program) {
						$iconOuput = '<li class="actionBar-program-icon" data-program-id="' . $program['program-id'] . '" data-program-name="' . $program['name'] . '">' . $program['initials'] . '</li>';
					}

				$this->iconOutput =  '<nav>
										<ul id="program-icons">' 
											. $iconOuput .
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

		public function buildCalender() 
		{
			$this->calenderOutput = 'Test';
		}

		public function getCalender() 
		{
			if (!empty($this->calenderOutput)) {
				return $this->calenderOutput;
			} else {
				error_log("Failed to execute getCalender(). No Calender Output Found");
				return false;
			}
		}

		public function buildActionBar() 
		{
			if (!empty($this->iconOutput) && !empty($this->calenderOutput)) {
				$this->actionBarOutput = '<actionBar>' . $this->iconOutput . $this->calenderOutput . '</actionBar>';

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