<?php
  class Session {
    private array $messages;

    public function __construct() {
      session_start();

      if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
      }
        
      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['id']);    
    }

    public function logout() {
      session_destroy();
    }

    public function getId() : ?int {
      return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function getIsOwner() : ?bool {
      return $_SESSION['isOwner']; 
    }

    public function getCsrfToken() : ?string {
      return isset($_SESSION['csrf']) ? $_SESSION['csrf'] : null;
    }

    public function setCsrfToken(string $csrfToken) {
      $_SESSION['csrf'] = $csrfToken;
    }

    public function setId(int $id) {
      $_SESSION['id'] = $id;
    }

    public function setIsOwner(){
      $_SESSION['isOwner'] = true;
    }

    public function setIsNotOwner(){
      $_SESSION['isOwner'] = false;
    }

    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }

   
  }
?>