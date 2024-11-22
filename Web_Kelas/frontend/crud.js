const productCardsContainer = document.getElementById("productCards");
const addProductForm = document.getElementById("addProductForm");

// Event Listener untuk Add Product
addProductForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const productData = {
    name: document.getElementById("newProductName").value.trim(),
    description: document.getElementById("newProductDescription").value.trim(),
    image_url: document.getElementById("newProductImage").value.trim(),
  };
  await addProduct(productData);
  addProductForm.reset();
});

// Load Products
const loadProducts = async () => {
  try {
    const response = await fetch(
      "http://localhost:8383/?module=product&action=getProducts"
    );
    const result = await response.json();
    const products = result.data;

    productCardsContainer.innerHTML = ""; // Clear existing cards
    products.forEach((product) => createProductCard(product));
  } catch (error) {
    console.error("Error loading products:", error);
  }
};

// Create Product Card
const createProductCard = (product) => {
  const card = document.createElement("div");
  card.className = "product-card";
  card.innerHTML = `
    <img src="${product.image_url}" alt="${sanitizeHTML(product.name)}" />
    <div class="product-info">
      <h3>${sanitizeHTML(product.name)}</h3>
      <p>${sanitizeHTML(product.description)}</p>
    </div>
    <div class="card-actions">
      <button class="edit-btn" data-id="${product.id}">Edit</button>
      <button class="delete-btn" data-id="${product.id}">Delete</button>
    </div>
  `;
  productCardsContainer.appendChild(card);

  // Add event listeners for edit and delete
  card
    .querySelector(".edit-btn")
    .addEventListener("click", () => editProduct(product));
  card
    .querySelector(".delete-btn")
    .addEventListener("click", () => deleteProduct(product.id));
};

// Add Product
const addProduct = async (productData) => {
  try {
    const response = await fetch(
      "http://localhost:8383?module=product&action=createProduct",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(productData),
      }
    );
    const result = await response.json();
    if (result.code === 201) {
      alert("Product added successfully!");
      loadProducts();
    } else {
      alert("Failed to add product.");
    }
  } catch (error) {
    console.error("Error adding product:", error);
  }
};

// Edit Product
const editProduct = (product) => {
  const updatedName = prompt("Edit Product Name:", product.name);
  const updatedDescription = prompt(
    "Edit Product Description:",
    product.description
  );
  const updatedImage = prompt("Edit Product Image URL:", product.image_url);

  if (updatedName && updatedDescription && updatedImage) {
    updateProduct(product.id, {
      name: updatedName,
      description: updatedDescription,
      image_url: updatedImage,
    });
  }
};

// Update Product
const updateProduct = async (id, productData) => {
  try {
    const response = await fetch(
      `http://localhost:8383?module=product&action=updateProduct&id=${id}`,
      {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(productData),
      }
    );
    const result = await response.json();
    if (result.code === 200) {
      alert("Product updated successfully!");
      loadProducts();
    } else {
      alert("Failed to update product.");
    }
  } catch (error) {
    console.error("Error updating product:", error);
  }
};

// Delete Product
const deleteProduct = async (id) => {
  if (confirm("Are you sure you want to delete this product?")) {
    try {
      const response = await fetch(
        `http://localhost:8383?module=product&action=deleteProduct&id=${id}`,
        {
          method: "DELETE",
        }
      );
      const result = await response.json();
      if (result.code === 200) {
        alert("Product deleted successfully!");
        loadProducts();
      } else {
        alert("Failed to delete product.");
      }
    } catch (error) {
      console.error("Error deleting product:", error);
    }
  }
};

// Sanitize HTML to avoid XSS
const sanitizeHTML = (str) => {
  const tempDiv = document.createElement("div");
  tempDiv.textContent = str;
  return tempDiv.innerHTML;
};

// Load products on page load
document.addEventListener("DOMContentLoaded", loadProducts);
