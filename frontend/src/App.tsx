// frontend/src/App.tsx
import { useState } from 'react';
import './styles/ui.css';
import Sidebar from './components/Sidebar';
import Header from './components/Header';
import FilterBar from './components/FilterBar';
import CharacterGrid from './components/CharacterGrid';

export type Filters = {
  tier: string | null;
  attributes: string[]; // e.g., ['Pyro','Sword']
};

export default function App() {
  const [filters, setFilters] = useState<Filters>({ tier: null, attributes: [] });
  const [searchTerm, setSearchTerm] = useState('');

  function handleTierChange(tier: string | null) {
    setFilters(prev => ({ ...prev, tier }));
  }

  function handleToggleAttribute(attr: string) {
    setFilters(prev => {
      const exists = prev.attributes.includes(attr);
      return {
        ...prev,
        attributes: exists ? prev.attributes.filter(a => a !== attr) : [...prev.attributes, attr],
      };
    });
  }

  return (
    <div className="app-root">
      <Sidebar />

      <div className="main-area">
        <Header onSearch={setSearchTerm} />

        <main className="content-area">
          <FilterBar
            selectedTier={filters.tier}
            onTierChange={handleTierChange}
            selectedAttributes={filters.attributes}
            onToggleAttribute={handleToggleAttribute}
          />

          <CharacterGrid filters={filters} searchTerm={searchTerm} />
        </main>
      </div>
    </div>
  );
}