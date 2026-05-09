document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('navMenu');
  const header = document.getElementById('siteHeader');

  if (menuToggle) {
    menuToggle.addEventListener('click', () => {
      navMenu.classList.toggle('active');
    });
  }

  window.addEventListener('scroll', () => {
    if (window.scrollY > 24) {
      header.classList.add('header-scrolled');
    } else {
      header.classList.remove('header-scrolled');
    }
  });

  const form = document.getElementById('admissionForm');
  if (form) {
    const steps = Array.from(document.querySelectorAll('.form-step'));
    const progress = Array.from(document.querySelectorAll('.progress-step'));
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    let currentStep = 0;

    const updateFormSteps = () => {
      steps.forEach((step, index) => {
        step.classList.toggle('form-step-active', index === currentStep);
      });
      progress.forEach((item, index) => {
        item.classList.toggle('active', index <= currentStep);
      });
      prevBtn.style.display = currentStep === 0 ? 'none' : 'inline-flex';
      nextBtn.classList.toggle('hidden', currentStep === steps.length - 1);
      submitBtn.classList.toggle('hidden', currentStep !== steps.length - 1);
    };

    const validateStep = () => {
      const fields = steps[currentStep].querySelectorAll('input, select, textarea');
      return Array.from(fields).every((field) => field.checkValidity());
    };

    nextBtn.addEventListener('click', () => {
      if (validateStep()) {
        currentStep = Math.min(currentStep + 1, steps.length - 1);
        updateFormSteps();
        window.scrollTo({ top: form.offsetTop - 60, behavior: 'smooth' });
      } else {
        form.reportValidity();
      }
    });

    prevBtn.addEventListener('click', () => {
      currentStep = Math.max(currentStep - 1, 0);
      updateFormSteps();
      window.scrollTo({ top: form.offsetTop - 60, behavior: 'smooth' });
    });

    form.addEventListener('submit', (event) => {
      if (!validateStep()) {
        event.preventDefault();
        form.reportValidity();
      }
    });

    updateFormSteps();
  }
});
