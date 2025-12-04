<?php

function processaMarkdownSimples($texto) {
    // Converte **texto** em <strong>texto</strong>
    $texto = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $texto);
    
    // Converte *texto* em <em>texto</em>
    $texto = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $texto);
    
    // Converte quebras de linha em <br>
    return nl2br($texto);
}
?>