<?php

	namespace core\registry;

	class registry
	{

		private $registry;
        private $registryIdDump;

		public function loadRegistry() {
			// -- DB grab TODO

			$this->registry = $registry = array(
		        0 => array(
		                "id" => "example_program",
		                "name" => "Example Program",
		                "initials" => "EP",
		                "active" => 1,
		                "filepath" => "exampleProgram"
		            )
		        );

            $this->registryIdDump = array(
                "id" => array(),
                "initials" => array()
                );
		}

		public function getRegistry()
		{
			return $this->registry;
		}

		public function filterInactivePrograms()
		{
			foreach ($this->registry as $program) {
		        if ($program['active'] === 0) {
		            unset($program);
		        }
		    }
		}

		public function checkRegistryForErrors()
		{

			$fatalError = 0;

			foreach ($this->registry as $program) {
                if (in_array($program['id'], $this->registryIdDump['id'])) {
                    $fatalError = 1;
                    error_log("Duplicate Program ID's found in registry.");
                } else {
                    array_push($this->registryIdDump['id'], $program['id']);
                }

		        // Check for duplicate registry initials
		        if (in_array($program['id'], $this->registryIdDump['initials'])) {
		            $fatalError = 1;
		            error_log("Duplicate Program initials found in registry.");
		        }

		    }

		    // Check for at least one active program in registry
		    if (empty($this->registry)) {
		        $fatalError = 1;
		        error_log("No active programs found in registry.");
		    }

			return $fatalError === 1 ? false : true;

		}

        public function getRegistryProgramDetails($programId)
        {
            foreach ($this->registry as $program) {
                if ($programId == $this->programId)
                    return $program;
            }
            return false;

        }


	}
