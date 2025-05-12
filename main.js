fetch('http://178.255.128.61:2512/Franck_L/Testmeubles/api_meubles.php')
  .then(response => response.json())
  .then(data => {
    const container = document.getElementById('meubles');
    container.innerHTML = ''; // Vider le contenu précédent s'il y en a

    data.forEach(item => {
      const imageUrl = `http://178.255.128.61:2512/Franck_L/Testmeubles/image/${item.image}`;
      console.log(imageUrl); // Pour déboguer

      container.innerHTML += `
        <div class="meuble-item">
          <img src="${imageUrl}" 
               alt="${item.nom}" 
               class="meuble-image"
               onerror="this.onerror=null;this.src='placeholder.jpg';this.alt='Image non disponible';">
          <div class="meuble-details">
            <h3>${item.nom}</h3>
            <p>Prix : ${item.prix.toFixed(2)} €</p>
          </div>
        </div>
      `;
    });
  })
  .catch(error => {
    console.error("Erreur lors de la récupération des meubles :", error);
    document.getElementById('meubles').innerHTML = "<p>Impossible de charger les meubles.</p>";
  });
