/**
 * Script para expandir/ocultar seções do currículo
 * Fornece funcionalidade de toggle com animação suave
 */

document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os botões de toggle
    const toggleButtons = document.querySelectorAll('.toggle-btn');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Obtém a seção de conteúdo associada ao botão
            const section = this.closest('section');
            const content = section.querySelector('.section-content');
            const isOpen = section.classList.contains('open');
            
            // Toggle da classe 'open'
            if (isOpen) {
                // Fechar seção
                closeSection(section, content, this);
            } else {
                // Abrir seção
                openSection(section, content, this);
            }
        });
    });
});

/**
 * Abre uma seção com animação suave
 */
function openSection(section, content, button) {
    // Define a altura do conteúdo para a animação
    content.style.maxHeight = content.scrollHeight + 'px';
    content.style.opacity = '1';
    
    // Adiciona a classe 'open'
    section.classList.add('open');
    
    // Rotaciona o ícone do botão
    const icon = button.querySelector('i');
    if (icon) {
        icon.style.transform = 'rotate(180deg)';
    }
}

/**
 * Fecha uma seção com animação suave
 */
function closeSection(section, content, button) {
    // Reset da altura e opacidade
    content.style.maxHeight = '0';
    content.style.opacity = '0';
    
    // Remove a classe 'open'
    section.classList.remove('open');
    
    // Rotaciona o ícone do botão de volta
    const icon = button.querySelector('i');
    if (icon) {
        icon.style.transform = 'rotate(0deg)';
    }
}

/**
 * Função para expandir todas as seções
 */
function expandAll() {
    const sections = document.querySelectorAll('section.collapsible');
    sections.forEach(section => {
        if (!section.classList.contains('open')) {
            const button = section.querySelector('.toggle-btn');
            const content = section.querySelector('.section-content');
            openSection(section, content, button);
        }
    });
}

/**
 * Função para ocultar todas as seções
 */
function collapseAll() {
    const sections = document.querySelectorAll('section.collapsible');
    sections.forEach(section => {
        if (section.classList.contains('open')) {
            const button = section.querySelector('.toggle-btn');
            const content = section.querySelector('.section-content');
            closeSection(section, content, button);
        }
    });
}

// Exporta funções para uso global se necessário
window.expandAll = expandAll;
window.collapseAll = collapseAll;
