import './App.css';

function App() {
  return (
    <div className="App">
      <div className="sidebar">
        <div className="sidebar-header">
          <h3>Bazaar</h3>
        </div>
        <ul className="sidebar-menu">
          <li><a href="#home">Home</a></li>
          <li><a href="#order">Orders</a></li>
          <li><a href="#products">Products</a></li>
          <li><a href="#customers">Customers</a></li>
          <li><a href="#analytics">Analytics</a></li>
          <li><a href="#marketing">Marketing</a></li>
          <li><a href="#integration">Integration</a></li>
          <li><a href="#discounts">Discounts</a></li>
        </ul>
      </div>
      
        <div className="searchBar">
          <input type="text" placeholder="Search..." />
        </div>
        <header className="App-header">
          <div className='box1'>
            <div className='box-content'>
              <h1>Get the very best Apps for your store</h1>
              <p>Update to the new checkout automation.</p>
              <div className='find-app'>
                <button>Find App</button>
                </div>
            </div>   
            </div>
        </header>


      <div className="orders">
        <h2>Orders</h2>
        <div className="order-buttons">
          <button className='btn'>Export</button>
          <button className='btn'>More Actions</button>
          <button className='btn'>Create Orders</button>
        </div>

        <div className="order-info-box">
          <p>Today</p>
          <p>Total Orders</p>
          <p>0</p>
          <p>Items ordered over time</p>
          <p>$0</p>
          <p>Average Order Value</p>  
        </div>
      </div>

    </div>
  );
}

export default App;
