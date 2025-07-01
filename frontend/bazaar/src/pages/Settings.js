import React, { useState } from 'react';
import './Settings.css'; // You'll need to create this CSS file

function Settings() {
  const [activeTab, setActiveTab] = useState('plan');
  
  return (
    <div className="settings-container">
      <h1 className="settings-title">Settings</h1>
      
      {/* these are the settings tabs */}
      <div className="settings-tabs">
        <button 
          className={activeTab === 'general' ? 'tab-active' : ''}
          onClick={() => setActiveTab('general')}>
        </button>
        <button 
          className={activeTab === 'apps' ? 'tab-active' : ''}
          onClick={() => setActiveTab('apps')}>
          Apps
        </button>
        <button 
          className={activeTab === 'notification' ? 'tab-active' : ''}
          onClick={() => setActiveTab('notification')}>
          Notification
        </button>
        <button 
          className={activeTab === 'plan' ? 'tab-active' : ''}
          onClick={() => setActiveTab('plan')}>
          Plan
        </button>
        <button 
          className={activeTab === 'security' ? 'tab-active' : ''}
          onClick={() => setActiveTab('security')}>
          Security
        </button>
      </div>
      
      {/* Plan section */}
      {activeTab === 'plan' && (
        <div className="plan-section">
          <h2 className="section-title">Plan</h2>
          
          <div className="pricing-cards">
            {/* Business Plan Card */}
            <div className="pricing-card">
              <div className="pricing-header">
                <h3>Business</h3>
                <p>For solo entrepreneurs</p>
              </div>
              
              <div className="pricing-price">
                <span className="price-currency">$</span>
                <span className="price-amount">19</span>
                <span className="price-period">/month</span>
              </div>
              
              <button className="plan-button current">Current plan</button>
              
              <div className="plan-features">
                <h4>Free features</h4>
                <ul className="features-list">
                  <li><span className="feature-icon">●</span> 10 inventory locations</li>
                  <li><span className="feature-icon">●</span> 24/7 chat support</li>
                  <li><span className="feature-icon">●</span> Localized global selling (5 markets)</li>
                  <li><span className="feature-icon">●</span> POS Lite</li>
                </ul>
              </div>
            </div>
            
            {/* Advanced Plan Card */}
            <div className="pricing-card popular">
              <div className="popular-badge">★ MOST POPULAR ★</div>
              <div className="pricing-header">
                <h3>Advanced</h3>
                <p>As your business scales</p>
              </div>
              
              <div className="pricing-price">
                <span className="price-currency">$</span>
                <span className="price-amount">299</span>
                <span className="price-period">/month</span>
              </div>
              
              <button className="plan-button get-started">Get Started</button>
              
              <div className="plan-features">
                <h4>Free features</h4>
                <ul className="features-list">
                  <li><span className="feature-icon">●</span> Custom reports and analytics</li>
                  <li><span className="feature-icon">●</span> 10 inventory locations</li>
                  <li><span className="feature-icon">●</span> Enhanced 24/7 chat support</li>
                  <li><span className="feature-icon">●</span> Localized global selling (5 markets) + add markets for $59 USD/mo each</li>
                  <li><span className="feature-icon">●</span> 15 additional staff accounts</li>
                  <li><span className="feature-icon">●</span> 10x checkout capacity</li>
                  <li><span className="feature-icon">●</span> POS Lite</li>
                </ul>
              </div>
            </div>
            
            {/* Plus Plan Card */}
            <div className="pricing-card">
              <div className="pricing-header">
                <h3>Plus</h3>
                <p>For more complex businesses</p>
              </div>
              
              <div className="pricing-price">
                <span className="price-currency"></span>
                <span className="price-amount">2,300</span>
                <span className="price-period">/month</span>
              </div>
              
              <button className="plan-button get-started">Get Started</button>
              
              <div className="plan-features">
                <h4>Free features</h4>
                <ul className="features-list">
                  <li><span className="feature-icon">●</span> Custom reports and analytics</li>
                  <li><span className="feature-icon">●</span> 200 inventory locations</li>
                  <li><span className="feature-icon">●</span> Priority 24/7 phone support</li>
                  <li><span className="feature-icon">●</span> Localized global selling (20 markets)</li>
                  <li><span className="feature-icon">●</span> Unlimited staff accounts</li>
                  <li><span className="feature-icon">●</span> Fully customizable checkout with 40x capacity</li>
                  <li><span className="feature-icon">●</span> Sell wholesale/B2B</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      )}
      
      {/* Placeholder content for other tabs */}
      {activeTab === 'general' && (
        <div className="general-settings">
          <h2 className="section-title">General Settings</h2>
          <p>Configure your store's general settings here.</p>
        </div>
      )}
      
      {activeTab === 'apps' && (
        <div className="apps-settings">
          <h2 className="section-title">Apps</h2>
          <p>Manage your store's applications and integrations.</p>
        </div>
      )}
      
      {activeTab === 'notification' && (
        <div className="notification-settings">
          <h2 className="section-title">Notifications</h2>
          <p>Configure how and when you receive notifications.</p>
        </div>
      )}
      
      {activeTab === 'security' && (
        <div className="security-settings">
          <h2 className="section-title">Security</h2>
          <p>Manage your store's security settings and permissions.</p>
        </div>
      )}
    </div>
  );
}

export default Settings;