import React from 'react';

type Props = {
  selectedTier: string | null;
  onTierChange: (tier: string | null) => void;
  selectedAttributes: string[];
  onToggleAttribute: (attr: string) => void;
};

const TIERS = ['S', 'A', 'B', 'C', 'D'];
const ELEMENTS = ['Pyro', 'Hydro', 'Anemo', 'Electro', 'Cryo', 'Geo'];
const WEAPONS = ['Sword', 'Claymore', 'Polearm', 'Bow', 'Catalyst'];
const ROLES = ['DPS', 'Support', 'Healer'];

const FilterBar: React.FC<Props> = ({ selectedTier, onTierChange, selectedAttributes, onToggleAttribute }) => {
  return (
    <div className="filter-bar">
      <div className="tier-row">
        {TIERS.map(t => (
          <button
            key={t}
            className={`tier-btn ${selectedTier === t ? 'active' : ''}`}
            onClick={() => onTierChange(selectedTier === t ? null : t)}
          >
            {t}
          </button>
        ))}
      </div>

      <div className="attr-row">
        <div className="attr-group">
          {ELEMENTS.map(el => (
            <button
              key={el}
              className={`attr-btn ${selectedAttributes.includes(el) ? 'active' : ''}`}
              onClick={() => onToggleAttribute(el)}
              title={el}
            >
              {el}
            </button>
          ))}
        </div>

        <div className="attr-group">
          {WEAPONS.map(w => (
            <button
              key={w}
              className={`attr-btn ${selectedAttributes.includes(w) ? 'active' : ''}`}
              onClick={() => onToggleAttribute(w)}
              title={w}
            >
              {w[0]}
            </button>
          ))}
        </div>

        <div className="attr-group">
          {ROLES.map(r => (
            <button
              key={r}
              className={`attr-btn ${selectedAttributes.includes(r) ? 'active' : ''}`}
              onClick={() => onToggleAttribute(r)}
              title={r}
            >
              {r}
            </button>
          ))}
        </div>
      </div>
    </div>
  );
};

export default FilterBar;
