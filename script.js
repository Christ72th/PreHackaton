function MontrerMenu() {
    const menuHamburger = document.querySelector(".Menu-Hamburger")
    const NavLinks = document.querySelector(".NavLinks")
    menuHamburger.addEventListener('click',()=>{
        NavLinks.classList.toggle('Mobile-Menu')
    }
    )
}

function Active() {
    const liens = document.querySelectorAll(".lien");

    liens.forEach(lien => {
        lien.addEventListener('click', () => {
            liens.forEach(l => l.classList.remove('active'));
            lien.classList.add("active");
            updateProgressBar(); 
        });
    });
}

function updateProgressBar() {
    const sections = document.querySelectorAll('.section');
    const progressBar = document.querySelector('.progressBar');
    const windowHeight = window.innerHeight;
    let currentSectionIndex = 0;

    sections.forEach((section, index) => {
        const rect = section.getBoundingClientRect();
        if (rect.top <= windowHeight / 2 && rect.bottom >= windowHeight / 2) {
            currentSectionIndex = index;
        }
    });

    const progress = (currentSectionIndex / (sections.length - 1)) * 100;
    requestAnimationFrame(() => { 
        progressBar.style.width = `${progress}%`;
    });

    sections.forEach((section, index) => {
        if (index === currentSectionIndex) {
            section.classList.add('active');
        } else {
            section.classList.remove('active');
        }
    });
}

function gererAffichageSections() {
    const NavLinks = document.querySelectorAll('nav.navigation ul li a');
    const sections = document.querySelectorAll('.section');

    /*function setActiveSection(sectionId) {
        sections.forEach(section => {
            section.classList.remove('active');
        });
        document.getElementById(sectionId).classList.add('active');
    }

    NavLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const sectionId = this.getAttribute('href').substring(1);
            setActiveSection(sectionId);
            updateProgressBar(); // Mettre à jour la barre de progression lors du clic
        });
    });*/
}

MontrerMenu();
Active();
updateProgressBar();
gererAffichageSections();
window.addEventListener('scroll', updateProgressBar);

        // JavaScript pour gérer la fenêtre modale
        var modal = document.getElementById("parametresModal");
        var btn = document.getElementById("parametresBtn");
        var span = document.getElementsByClassName("close")[0];
        
        btn.onclick = function() {
            modal.style.display = "block";
        }
        
        span.onclick = function() {
            modal.style.display = "none";
        }
        
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }