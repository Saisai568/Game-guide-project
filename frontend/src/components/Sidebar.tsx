import React from 'react';

const Sidebar: React.FC = () => {
  return (
    <aside className="sidebar">
      <div className="sidebar-top">
        <div className="logo">ZZZ.GG</div>
      </div>

      <nav className="nav">
        <ul>
          <li className="nav-item">🏠 主頁</li>
          <li className="nav-item">🧑‍🎮 角色</li>
          <li className="nav-item">🗡️ 裝備</li>
          <li className="nav-item">🔮 聖遺物</li>
          <li className="nav-item">📜 任務</li>
          <li className="nav-item">📚 指南</li>
        </ul>
      </nav>

      <div className="sidebar-bottom">
        <div className="lang-select">
          <button className="lang">EN</button>
          <button className="lang">韓</button>
          <button className="lang active">日</button>
        </div>
      </div>
    </aside>
  );
};

export default Sidebar;
