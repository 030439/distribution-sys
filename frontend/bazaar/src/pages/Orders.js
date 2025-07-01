import { useState } from 'react';

function Orders() {
  const [activeTab, setActiveTab] = useState('all');

  return (
    <>
      {/* banners */}
      <div className="promo-banner">
        <div className="banner-content">
          <h2>Get the very best apps for your store</h2>
          <p>Upgrade to the new checkout automation.</p>
          <button className="find-app-btn">Find Apps</button>
        </div>
        <div className="banner-icons">
          {/* will put app icons here like shopify etc */}
        </div>
      </div>

      {/* Orders Section */}
      <div className="orders-section">
        <div className="orders-header">
          <h2>Orders</h2>
          <div className="action-buttons">
            <button className="btn secondary">Export</button>
            <button className="btn secondary dropdown">More actions</button>
            <button className="btn primary">Create Order</button>
          </div>
        </div>

        {/* Stats Cards */}
        <div className="stats-cards">
          <div className="stats-card">
            <div className="stat-title">Today</div>
            <div className="stat-value">48</div>
          </div>
          <div className="stats-card">
            <div className="stat-title">Total orders over time</div>
            <div className="stat-value">493</div>
          </div>
          <div className="stats-card">
            <div className="stat-title">Returns</div>
            <div className="stat-value">6</div>
          </div>
          <div className="stats-card">
            <div className="stat-title">Fulfilled orders over time</div>
            <div className="stat-value">369</div>
          </div>
          <div className="stats-card">
            <div className="stat-title">Delivered orders over time</div>
            <div className="stat-value">353</div>
          </div>
        </div>

        <div className="order-tabs">
          <button 
            className={activeTab === 'all' ? 'tab-active' : ''} 
            onClick={() => setActiveTab('all')}>All</button>
          <button 
            className={activeTab === 'unpaid' ? 'tab-active' : ''} 
            onClick={() => setActiveTab('unpaid')}>Unpaid</button>
          <button 
            className={activeTab === 'needToShip' ? 'tab-active' : ''} 
            onClick={() => setActiveTab('needToShip')}>Need to ship</button>
          <button 
            className={activeTab === 'sent' ? 'tab-active' : ''} 
            onClick={() => setActiveTab('sent')}>Sent</button>
          <button 
            className={activeTab === 'completed' ? 'tab-active' : ''} 
            onClick={() => setActiveTab('completed')}>Completed</button>
          <button 
            className={activeTab === 'cancellation' ? 'tab-active' : ''} 
            onClick={() => setActiveTab('cancellation')}>Cancellation</button>
          <button 
            className={activeTab === 'returns' ? 'tab-active' : ''} 
            onClick={() => setActiveTab('returns')}>Returns</button>
        </div>

        {/* search bar for ordering */}
        <div className="order-search">
          <div className="search-input">
            <i className="icon-search"></i>
            <input type="text" placeholder="Search order..." />
          </div>
          <div className="view-controls">
            <button className="view-grid-btn"><i className="icon-grid"></i></button>
            <button className="view-list-btn active"><i className="icon-list"></i></button>
            <button className="filter-btn">Filter</button>
          </div>
        </div>

        {/*i'll change this when connect to backend */}
        <div className="orders-table">
          <table>
            <thead>
              <tr>
                <th><input type="checkbox" /></th>
                <th>ORDER</th>
                <th>CUSTOMER</th>
                <th>DATE</th>
                <th>TOTAL</th>
                <th>PAYMENT STATUS</th>
                <th>ITEMS</th>
                <th>DELIVERY METHOD</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox" /></td>
                <td>
                  <div className="order-item">
                    <img src="/product-icon.png" alt="Product" className="product-thumbnail" />
                    <div>MacBook Air M1, 2020</div>
                    <div className="product-id">#123456</div>
                  </div>
                </td>
                <td>
                  <div className="customer">
                    <div className="customer-avatar">DH</div>
                    <div>Darrell Howard</div>
                  </div>
                </td>
                <td>Apr 19, 08:01 AM</td>
                <td>100Rs</td>
                <td><span className="status pending">Pending</span></td>
                <td>1 items</td>
                <td>Free Shipping</td>
                <td><button className="more-btn">⋮</button></td>
              </tr>
              {/* all this data will be fetched from db this is only dummy data */}
            </tbody>
          </table>
        </div>

        {/* pagination */}
        <div className="pagination">
          <div className="items-per-page">
            Items per page: <select><option>10</option>
            <option>20</option>
            <option>30</option>
            </select>
          </div>
          <div className="page-controls">
            <button className="previous-btn">← Previous</button>
            <button className="page-number active">1</button>
            <button className="page-number">2</button>
            <button className="page-number">3</button>
            <button className="page-number">4</button>
            <span>...</span>
            <button className="page-number">30</button>
            <button className="next-btn">Next →</button>
          </div>
        </div>
      </div>
    </>
  );
}

export default Orders;