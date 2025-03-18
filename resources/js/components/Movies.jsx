import React, {useEffect, useState} from 'react';
import axios from 'axios';
import '../../css/app.css';

function Movies() {

    const [movies, setMovies] = useState([]);

    useEffect(() => {
        axios.get('/api/movies')
            .then(response => setMovies(response.data))
            .catch(error => console.error('Error fetching movies:', error));
    }, []);

    return (

        <div className="flex flex-wrap justify-center items-stretch gap-6 p-10 mx-auto max-w-7xl">
            {movies.map((movie, index) => (
                <div key={index}
                     className="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col max-w-[220px] w-full text-center">
                    <img src={movie.cover_picture?.path} alt="Cover" className="w-full h-48 object-cover mb-4"/>
                    <h3 className="text-lg font-semibold mb-2">{movie.title}</h3>
                    <p className='text-grey-600 flex-1 p-2'>{movie.description}</p>
                    <p className="text-sm text-gray-500">Language: <span
                        className="font-bold">{movie.language}</span>
                    </p>
                    <p className="text-sm text-gray-500">Age Restriction: <span
                        className="font-bold">{movie.age_restriction}</span>
                    </p>
                    {movie.showtime_details && movie.showtime_details.length > 0 ? (
                        movie.showtime_details.map((showtimeDetail, index) => (
                            <div key={index} className="p-1 m-1">
                                <p className="text-sm text-gray-500">Showtime: {showtimeDetail.showtime}</p>
                                <p className="text-sm text-gray-500">Available
                                    Seats: {showtimeDetail.available_seats}</p>
                            </div>
                        ))
                    ) : <p className="text-sm text-red-500">No showtimes available!</p>}
                </div>
            ))}
        </div>
    );
}

export default Movies;
