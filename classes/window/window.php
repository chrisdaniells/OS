<?php

    namespace core\window;

    class window
    {

        private $programId;
        private $programDetails;
        private $programHTML;

        public function __construct($programId)
        {
            $this->programId = $programId;
            if (isset($registry) && !empty($registry)) {
                $this->programDetails = $registry->getProgramDetails($this->programDetails);
            }
        }

        private function getProgramMenu()
        {
            if(file_exists($_SESSION['root'] . '/programs/' . $this->programId . '/src/html/menu.php')) {
                return file_get_contents($_SESSION['root'] . '/programs/' . $this->programId . '/src/html/menu.php');
            }

            return false;
        }

        private function getProgramMain()
        {
            if(file_exists($_SESSION['root'] . '/programs/' . $this->programId . '/index.php')) {
                include $_SESSION['root'] . '/programs/' . $this->programId . '/index.php';

                if (!empty($programOutput) && isset($programOutput)) {
                    return $programOutput;
                }
            }

            return false;
        }

        public function getProgram()
        {
            $this->programHTML = '<window data-program-id="' . $this->programId . '">
                                    <program>';
                $this->programHTML .= '<action>';
                    $this->programHTML .= '<actionitem data-command="close" class="close"></actionitem>';
                    $this->programHTML .= '<actionitem data-command="minimise" class="minimise"></actionitem>';
                    $this->programHTML .= ($this->getProgramMenu() ? '<divider></divider>' . $this->getProgramMenu() : '');
                $this->programHTML .= '</action>';
                $this->programHTML .= $this->getProgramMain();
            $this->programHTML .= '</program></window>';

            return $this->programHTML;
        }
    }
