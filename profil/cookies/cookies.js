document.getElementById('cookie-settings-form').addEventListener('submit', function(event) {
      event.preventDefault();
      const performanceCookies = document.getElementById('performance-cookies').checked;
      const functionalityCookies = document.getElementById('functionality-cookies').checked;
      const advertisingCookies = document.getElementById('advertising-cookies').checked;
  
      document.cookie = `performanceCookies=${performanceCookies}; path=/;`;
      document.cookie = `functionalityCookies=${functionalityCookies}; path=/;`;
      document.cookie = `advertisingCookies=${advertisingCookies}; path=/;`;
  
      alert('Vos préférences de cookies ont été enregistrées.');
  });