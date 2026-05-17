<nav class="bottom-nav">
 <a class="{{ request()->routeIs('home')?'active':'' }}" href="{{ route('home') }}">
  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5V21h-6v-6H9v6H3z"/></svg>Beranda
 </a>
 <a class="{{ request()->routeIs('schedule')?'active':'' }}" href="{{ route('schedule') }}">
  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 3v4M17 3v4M4 8h16M5 5h14v16H5z"/></svg>Jadwal
 </a>
 <a class="{{ request()->routeIs('favorite')?'active':'' }}" href="{{ route('favorite') }}">
  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>Favorit
 </a>
 <a class="{{ request()->routeIs('settings')||request()->routeIs('profile*')||request()->routeIs('help')?'active':'' }}" href="{{ route('settings') }}">
  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15.5A3.5 3.5 0 1 0 12 8a3.5 3.5 0 0 0 0 7.5z"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2 3.4-.2-.1a1.7 1.7 0 0 0-2 .1 7.6 7.6 0 0 1-1.6.7 1.7 1.7 0 0 0-1.2 1.6V23H8.9v-.3a1.7 1.7 0 0 0-1.2-1.6 7.6 7.6 0 0 1-1.6-.7 1.7 1.7 0 0 0-2-.1l-.2.1-2-3.4.1-.1A1.7 1.7 0 0 0 2.6 15a7.5 7.5 0 0 1 0-2 1.7 1.7 0 0 0-.3-1.9l-.1-.1 2-3.4.2.1a1.7 1.7 0 0 0 2-.1 7.6 7.6 0 0 1 1.6-.7A1.7 1.7 0 0 0 9 5.3V5h4v.3a1.7 1.7 0 0 0 1.2 1.6 7.6 7.6 0 0 1 1.6.7 1.7 1.7 0 0 0 2 .1l.2-.1 2 3.4-.1.1a1.7 1.7 0 0 0-.3 1.9 7.5 7.5 0 0 1 0 2z"/></svg>Pengaturan
 </a>
</nav>
