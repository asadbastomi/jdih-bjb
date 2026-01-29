# AI Chat Feature for JDIH Kota Banjarmasin

## Overview
A new AI-like chat assistant has been implemented for the JDIH Kota Banjarmasin website. This feature allows users to interact with a virtual assistant to search for legal documents (Perda, Perwal, etc.), get summaries, check document status, and download files.

## Features Implemented

### 1. Intelligent Response System
- Greeting responses (halo, hi, hello, selamat pagi/siang/sore/malam)
- Positive acknowledgment handling (ya, oke, ok, baik, siap)
- Keyword extraction and search optimization
- Natural language understanding for legal document queries

### 2. Search Capabilities
- **General Search**: Search for regulations by topic/keywords
- **Exact Match Prioritization**: Exact phrase matches in titles are returned first
- **Partial Matching**: Falls back to partial keyword matching when no exact match found
- **Brief Results View**: Shows multiple relevant results when no exact match exists

### 3. Specialized Commands
- **Download Request**: "unduh perda pajak daerah" or "download perwal ketenteraman"
- **Summary Request**: "Ringkasan perda tentang pemberdayaan usaha mikro"
- **Status Check**: "Status perwal perencanaan pembangunan daerah"

### 4. AI-Generated Responses
- Detailed document information
- Automatic summary generation from available data
- Relevance explanation
- Contact information for free legal consultation
- Download links with proper URL handling

## File Structure

### Backend
- `app/Http/Controllers/API/ChatController.php` - Main chat controller with AI logic
- `routes/api.php` - API endpoints for chat functionality

### Frontend
- `resources/views/public/chat-widget.blade.php` - Chat interface widget
- `resources/views/public/footer.blade.php` - Widget integration (included automatically)

### API Endpoints
- `POST /api/chat/message` - Process chat messages and get AI responses
- `GET /api/chat/examples` - Get example questions for users

## How It Works

### 1. User Interaction Flow
1. User clicks the chat widget button (bottom-right corner)
2. Chat window opens with greeting message
3. User types a question or selects an example
4. System processes the message and searches the database
5. AI-like response is generated and displayed
6. User can continue the conversation

### 2. Search Logic
1. Extract keywords from user message (removing stop words)
2. First attempt: Exact phrase match in document titles
3. Second attempt: Partial keyword matching across title, subject, field of law, and abstract
4. Results are ordered by date (newest first)

### 3. Response Generation
- Greetings: Welcome message with usage examples
- Search matches: Detailed document information with summary
- No matches: Helpful tips for better search terms
- Download/Summary/Status: Specialized formatted responses

## Download Link Handling
The system intelligently handles various file path formats:
- **Full URLs**: Already complete URLs starting with http:// or https://
- **Complete paths**: Paths starting with upload/ or storage/
- **Filenames only**: Constructs path using `tahun` and `kategori` fields

Example: For a regulation with `file = "Perda 10 Tahun 2025.pdf"`, `tahun = 2025`, and `kategori = "perda"`:
- Generated path: `upload/perda/2025/Perda 10 Tahun 2025.pdf`
- Full URL: `http://localhost:8000/upload/perda/2025/Perda 10 Tahun 2025.pdf`

This matches the file storage pattern used in PerdaController and PerwalController.

## Styling
- Modern gradient design with CSS variables
- Responsive layout for all screen sizes
- Smooth animations and transitions
- Professional color scheme matching JDIH branding
- Mobile-friendly interface

## Example Interactions

### Greeting
**User**: halo
**Response**: "Halo! Saya adalah asisten virtual JDIH Kota Banjarmasin. Ada yang bisa saya bantu terkait produk hukum?..."

### Search
**User**: Peraturan tentang ketenteraman dan ketertiban umum
**Response**: Detailed information about the regulation with summary and download link

### Download
**User**: Unduh perda pajak daerah dan retribusi daerah
**Response**: List of matching regulations with download buttons

### Summary
**User**: Ringkasan perda tentang pemberdayaan usaha mikro
**Response**: Summary of the regulation with key details

### Status
**User**: Status perwal perencanaan pembangunan daerah
**Response**: List of matching regulations with their status

## Customization

### Modify Greeting Message
Edit `ChatController.php` - `generateResponse()` method

### Change Example Questions
Edit `ChatController.php` - `getExamples()` method

### Adjust Search Algorithm
Edit `ChatController.php` - `searchRegulations()` method

### Update Widget Styling
Edit `chat-widget.blade.php` - CSS variables and styles

## Technical Details

### Dependencies
- Laravel Framework (already installed)
- jQuery (for AJAX requests)
- No external AI API required (uses database search and pattern matching)

### Performance
- Cached queries using Laravel Eloquent
- Efficient SQL with LIKE operators
- Limited result sets (max 20 results)
- Minimal server-side processing

### Security
- Input validation (max 500 characters)
- SQL injection protection via Eloquent ORM
- CSRF protection for all POST requests
- No sensitive data exposure

## Testing
To test the chat feature:
1. Open any public page on the website
2. Click the chat widget icon in the bottom-right corner
3. Try the example questions or type your own queries
4. Verify responses and download links work correctly

## Future Enhancements (Optional)
- Integrate with actual AI/LLM API for more natural conversations
- Add chat history for logged-in users
- Implement voice input/output
- Add multilingual support
- Include sentiment analysis for better responses
- Add document preview in chat

## Support
For issues or questions about the chat feature, please contact the development team.

---

**Implemented Date**: January 29, 2026
**Version**: 1.0.0