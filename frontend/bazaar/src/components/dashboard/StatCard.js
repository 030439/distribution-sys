import React from 'react';
import PropTypes from 'prop-types';

/**
 * A reusable stat card component for displaying metrics
 */
function StatCard({ title, value, icon, iconBgColor }) {
  return (
    <div className="stat-card">
      <div className="stat-icon" style={{ backgroundColor: iconBgColor || 'var(--bazaar-orange)' }}>
        {icon}
      </div>
      <div className="stat-details">
        <h3>{value}</h3>
        <p>{title}</p>
      </div>
    </div>
  );
}

StatCard.propTypes = {
  title: PropTypes.string.isRequired,
  value: PropTypes.oneOfType([PropTypes.string, PropTypes.number]).isRequired,
  icon: PropTypes.node,
  iconBgColor: PropTypes.string
};

export default StatCard;
