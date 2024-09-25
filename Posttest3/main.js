document.addEventListener('DOMContentLoaded', function () {
    const signInBtn = document.querySelector('a[href="#sign-in"]');
    const createAccountBtn = document.querySelector('a[href="#create-account"]');
    const filmsBtn = document.querySelector('a[href="#films"]');
    
    signInBtn.addEventListener('click', function (e) {
      e.preventDefault();
      alert('Coming soon coy!!');
    });
  
    createAccountBtn.addEventListener('click', function (e) {
      e.preventDefault();
      alert('Coming soon mamen!!');
    });

    filmsBtn.addEventListener('click', function (e) {
      e.preventDefault();
      alert('Coming soon ya bro!!');
    });

  });
