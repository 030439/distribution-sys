import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';

/**
 * Reusable component to display a list of products in a table
 */
function ProductsTable({ products, isLoading }) {
  if (isLoading) {
    return <p>Loading products...</p>;
  }
  
  if (products.length === 0) {
    return (
      <p className="no-data">No products found. <Link to="/products">Add your first product!</Link></p>
    );
  }

  return (
    <div className="recent-products">
      <table className="products-table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          {products.map((product) => (
            <tr key={product.id}>
              <td>
                {product.image_url ? (
                  <img 
                    src={product.image_url} 
                    alt={product.name} 
                    className="product-thumbnail" 
                  />
                ) : (
                  <div className="no-image">No Image</div>
                )}
              </td>
              <td>{product.name}</td>
              <td>${Number(product.price).toFixed(2)}</td>
              <td>{product.stock_quantity}</td>
              <td>
                <span className={`status-badge ${product.active ? 'active' : 'inactive'}`}>
                  {product.active ? 'Active' : 'Inactive'}
                </span>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

ProductsTable.propTypes = {
  products: PropTypes.array.isRequired,
  isLoading: PropTypes.bool
};

export default ProductsTable;
