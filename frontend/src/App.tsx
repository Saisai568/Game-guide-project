// frontend/src/App.tsx
import { useState, useEffect } from 'react';
// ...

export default function App() {
  const [guides, setGuides] = useState<any[]>([]);

  useEffect(() => {
    // Use a relative URL so Vite dev server can proxy `/api` to the backend and avoid CORS
    fetch('/api/guides')
      .then(res => res.json())
      .then(data => setGuides(data))
      .catch(error => console.error("Error fetching guides:", error));
  }, []);

  return (
    <div>
      <h1>🏆 遊戲攻略網站</h1>
      {guides.map((guide: any) => (
        <div key={guide.id}>
          <h2>{guide.title}</h2>
          <p>{guide.content}</p>
        </div>
      ))}
    </div>
  );
}