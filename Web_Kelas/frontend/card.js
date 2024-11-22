const displayProducts = async () => {
  try {
    const response = await fetch(
      "http://localhost:8383?module=product&action=getProducts"
    );
    if (!response.ok) {
      throw new Error(
        `Failed to fetch products: ${response.status} ${response.statusText}`
      );
    }

    const data = await response.json();

    if (!data.data || data.data.length === 0) {
      throw new Error("No products available");
    }

    const products = data.data;
    const contentContainer = document.querySelector("#product-preview");
    contentContainer.innerHTML = ""; // Bersihkan konten sebelumnya

    products.forEach((product) => {
      const productCard = document.createElement("div");
      productCard.className = "card";

      productCard.innerHTML = `
        <img src="${product.image_url}" alt="${sanitizeHTML(product.name)}" />
        <div class="card-body">
          <h3>${sanitizeHTML(product.name)}</h3>
          <p>${sanitizeHTML(product.description)}</p>
        </div>
        <div class="card-footer">
          <p>${new Date(product.created_at).toLocaleDateString()}</p>
          <p class="font-weight-bold">Read more</p>
        </div>
      `;

      contentContainer.appendChild(productCard);
    });
  } catch (error) {
    console.error("Error fetching products:", error);
    const contentContainer = document.querySelector("#product-preview");
    contentContainer.innerHTML = `<p class="error-message">Unable to load products. Please try again later.</p>`;
  }
};

const sanitizeHTML = (str) => {
  const tempDiv = document.createElement("div");
  tempDiv.textContent = str;
  return tempDiv.innerHTML;
};

document.addEventListener("DOMContentLoaded", displayProducts);
