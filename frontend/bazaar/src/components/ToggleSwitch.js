import React from 'react';
import '../components/Toggle.css';
import PropTypes from 'prop-types';

/**
 * Toggle switch component for boolean settings
 * @param {Object} props - Component props
 * @param {boolean} props.isOn - Whether the toggle is on
 * @param {Function} props.onToggle - Function to call when toggle is clicked
 * @param {string} props.label - Text label for the toggle
 * @param {string} props.description - Optional description text
 */
function ToggleSwitch({ isOn, onToggle, label, description }) {
  return (
    <div className="settings-option dark-mode">
      <div>
        <div className="option-label">{label}</div>
        {description && <div className="option-description">{description}</div>}
      </div>
      <label className="toggle-switch">
        <input type="checkbox" checked={isOn} onChange={onToggle} />
        <span className="toggle-slider"></span>
      </label>
    </div>
  );
}

ToggleSwitch.propTypes = {
  isOn: PropTypes.bool.isRequired,
  onToggle: PropTypes.func.isRequired,
  label: PropTypes.string.isRequired,
  description: PropTypes.string
};

export default ToggleSwitch;
