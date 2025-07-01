import { useState, useEffect } from 'react';
import ordersData from '../data/orders.json';
import './Orders.css'; 

function Orders() {
  const [activeTab, setActiveTab] = useState('all');
  const [orders, setOrders] = useState([]);
  const [slideDirection, setSlideDirection] = useState('right');
  
  // tab change handler with slide direction
  const handleTabChange = (tabName) => {
    if (activeTab === tabName) return;

    const tabOrder = ['all', 'unpaid', 'needToShip', 'sent', 'completed', 'cancellation', 'returns'];
    const currentIndex = tabOrder.indexOf(activeTab);
    const newIndex = tabOrder.indexOf(tabName);
    
    setSlideDirection(newIndex > currentIndex ? 'left' : 'right');
    setActiveTab(tabName);
  };
  
  // displaying orders when tab changes
  useEffect(() => {
    if (activeTab === 'all') {
      // combining orders from every categories for the 'all' tab
      // a sinlge array of all orders
      const allOrders = [
        ...(ordersData.unpaid || []),
        ...(ordersData.needToShip || []),
        ...(ordersData.sent || []),
        ...(ordersData.completed || []),
        ...(ordersData.cancellation || []),
        ...(ordersData.returns || [])
      ];
      
      // removing duplicates (in case same order is in multiple categories)
      const uniqueOrders = Array.from(
        new Map(allOrders.map(order => [order.id, order])).values()
      );
      
      setOrders(uniqueOrders);
    } else {
      // and for other tabs im just showing the specific category
      setOrders(ordersData[activeTab] || []);
    }
  }, [activeTab]);

  return (
    <>
      {/* banner(that comes after the search) */}
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
            onClick={() => handleTabChange('all')}>All</button>
          <button 
            className={activeTab === 'unpaid' ? 'tab-active' : ''} 
            onClick={() => handleTabChange('unpaid')}>Unpaid</button>
          <button 
            className={activeTab === 'needToShip' ? 'tab-active' : ''} 
            onClick={() => handleTabChange('needToShip')}>Need to ship</button>
          <button 
            className={activeTab === 'sent' ? 'tab-active' : ''} 
            onClick={() => handleTabChange('sent')}>Sent</button>
          <button 
            className={activeTab === 'completed' ? 'tab-active' : ''} 
            onClick={() => handleTabChange('completed')}>Completed</button>
          <button 
            className={activeTab === 'cancellation' ? 'tab-active' : ''} 
            onClick={() => handleTabChange('cancellation')}>Cancellation</button>
          <button 
            className={activeTab === 'returns' ? 'tab-active' : ''} 
            onClick={() => handleTabChange('returns')}>Returns</button>
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

        {/* Add the slide container around your orders table */}
        <div className="slide-container">
          <div className={`orders-table ${slideDirection === 'left' ? 'slide-in-left' : 'slide-in-right'}`}>
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
                {orders.length > 0 ? (
                  orders.map(order => (
                    <tr key={order.id}>
                      <td><input type="checkbox" /></td>
                      <td>
                        <div className="order-item">
                          <img src={order.product.image} alt={order.product.name} className="product-thumbnail" />
                          <div>
                            <div>{order.product.name}</div>
                            <div className="product-id">#{order.id}</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div className="customer">
                          <div className="customer-avatar">{order.customer.initials}</div>
                          <div>{order.customer.name}</div>
                        </div>
                      </td>
                      <td>{order.date}</td>
                      <td>{order.total}</td>
                      <td><span className={`status ${order.status}`}>{order.status}</span></td>
                      <td>{order.items} items</td>
                      <td>{order.delivery}</td>
                      <td><button className="more-btn">⋮</button></td>
                    </tr>
                  ))
                ) : (
                  <tr>
                    <td colSpan="9" className="no-orders">
                      No orders found in this category.
                    </td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
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