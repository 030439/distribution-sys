import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';

/**
 * component for the quick Actions section with action cards
 */
function QuickActions({ actions }) {
  return (
    <div className="quick-actions">
      {actions.map((action, index) => (
        <Link 
          key={index} 
          to={action.link} 
          className="action-card"
        >
          <div 
            className="action-icon" 
            style={action.bgColor ? { backgroundColor: action.bgColor } : {}}
          >
            {action.icon}
          </div>
          <span>{action.label}</span>
        </Link>
      ))}
    </div>
  );
}

QuickActions.propTypes = {
  actions: PropTypes.arrayOf(
    PropTypes.shape({
      icon: PropTypes.node.isRequired,
      label: PropTypes.string.isRequired,
      link: PropTypes.string.isRequired,
      bgColor: PropTypes.string
    })
  ).isRequired
};

export default QuickActions;
