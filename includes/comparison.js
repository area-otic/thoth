class ProgramComparator {
    constructor() {
        this.maxItems = 3;
        this.storageKey = 'comparePrograms';
        this.counterElement = document.getElementById('compareCounter');
        this.navLink = document.getElementById('compareNavLink');
        this.init();
    }

    init() {
        this.updateCounter();
        window.addEventListener('storage', (e) => {
            if (e.key === this.storageKey) {
                this.updateCounter();
            }
        });
        this.setupEventListeners();
    }

    getPrograms() {
        return JSON.parse(localStorage.getItem(this.storageKey)) || [];
    }

    savePrograms(programs) {
        localStorage.setItem(this.storageKey, JSON.stringify(programs));
        this.updateCounter();
        // Disparar evento para sincronizar otras pestañas
        window.dispatchEvent(new Event('storage'));
    }

    addProgram(programId) {
        const currentPrograms = this.getPrograms();
        
        if (currentPrograms.includes(programId)) {
            this.showAlert('info', 'Este programa ya está en tu comparación');
            return false;
        }
        
        if (currentPrograms.length >= this.maxItems) {
            this.showAlert('warning', `Solo puedes comparar hasta ${this.maxItems} programas`);
            return false;
        }
        
        const updatedPrograms = [...currentPrograms, programId];
        this.savePrograms(updatedPrograms);
        this.showAlert('success', 'Programa añadido a comparación');
        return true;
    }

    removeProgram(programId) {
        const currentPrograms = this.getPrograms();
        const updatedPrograms = currentPrograms.filter(id => id !== programId);
        this.savePrograms(updatedPrograms);
    }

    clearPrograms() {
        localStorage.removeItem(this.storageKey);
        this.updateCounter();
    }

    updateCounter() {
        if (!this.counterElement) return;
        
        const count = this.getPrograms().length;
        this.counterElement.textContent = count;
        
        if (count >= this.maxItems) {
            this.counterElement.style.backgroundColor = '#dc3545';
        } else {
            this.counterElement.style.backgroundColor = '#003366'; // Usa el color que tienes en tu navbar
        }
        
        this.counterElement.classList.add('pulse');
        setTimeout(() => {
            this.counterElement.classList.remove('pulse');
        }, 500);
    }

    showAlert(icon, title) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: icon,
                title: title,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                customClass: {
                    container: 'swal2-zindex'
                }
            });
            
            // Añadir estilo dinámicamente si no existe
            if (!document.getElementById('swal-zindex-style')) {
                const style = document.createElement('style');
                style.id = 'swal-zindex-style';
                style.textContent = `
                    .swal2-zindex {
                        z-index: 99999 !important;
                    }
                `;
                document.head.appendChild(style);
            }
        } else {
            console.log(title);
        }
    }

    setupEventListeners() {
        // Manejar clic en botones de comparación en toda la página
        document.addEventListener('click', (e) => {
            const compareBtn = e.target.closest('a[href^="comparacion.php?add="]');
            if (compareBtn) {
                e.preventDefault();
                const programId = new URL(compareBtn.href).searchParams.get('add');
                this.addProgram(programId);
            }
            
            // Manejar clic en el enlace del navbar
            if (e.target.closest('#compareNavLink')) {
                const programs = this.getPrograms();
                if (programs.length > 0) {
                    e.preventDefault();
                    window.location.href = `comparacion.php?ids=${programs.join(',')}`;
                }
            }
        });
    }
}

// Inicialización automática cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new ProgramComparator();
});