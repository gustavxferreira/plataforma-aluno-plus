<?php

session_start();
unset($_SESSION['token']);

echo "<script>
localStorage.removeItem('session');
localStorage.removeItem('autoSavedSql');
localStorage.removeItem('showThisQueryObject');
localStorage.removeItem('showThisQuery');
window.location.href = '/login'
</script>";
