import React, { useState } from 'react';

type Props = {
  onSearch?: (term: string) => void;
};

const Header: React.FC<Props> = ({ onSearch }) => {
  const [q, setQ] = useState('');

  function handleChange(e: React.ChangeEvent<HTMLInputElement>) {
    setQ(e.target.value);
    onSearch && onSearch(e.target.value);
  }

  return (
    <header className="header">
      <div className="header-left">
        <div className="site-name">ZZZ.GG</div>
      </div>

      <div className="header-center">
        <input
          className="search-input"
          placeholder="搜尋角色、武器、屬性..."
          value={q}
          onChange={handleChange}
        />
      </div>

      <div className="header-right">
        <button className="icon-btn">⚙️</button>
        <button className="icon-btn">🔔</button>
        <button className="icon-btn">❓</button>
      </div>
    </header>
  );
};

export default Header;
