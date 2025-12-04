// Lógica de Controle de Abas para a Página da Wiki
document.addEventListener('DOMContentLoaded', () => {
    // Seleciona todos os botões de aba e o conteúdo das abas
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    /**
     * Alterna a visualização para a aba especificada.
     * @param {string} tabName - O nome da aba (ex: 'info', 'gameplay', 'comments').
     */
    const switchTab = (tabName) => {
        // 1. Oculta todos os conteúdos e remove a classe 'active' de todos os botões
        tabContents.forEach(content => {
            content.classList.add('hidden');
            content.classList.remove('block'); 
        });
        tabButtons.forEach(button => button.classList.remove('active'));

        // 2. Mostra o conteúdo da aba selecionada e ativa o botão correspondente
        const activeContent = document.getElementById(`tab-${tabName}`);
        const activeBtn = document.getElementById(`tab-${tabName}-btn`);
        
        if (activeContent && activeBtn) {
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');
            activeBtn.classList.add('active');
        }
    };

    // Adiciona listener de clique para cada botão
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            switchTab(tabName);
        });
    });

    // Garante que a primeira aba ('info') esteja ativa ao carregar
    switchTab('news');
});